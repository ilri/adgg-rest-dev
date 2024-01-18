<?php
// src/Controller/SyncController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class SyncController extends AbstractController
{
    /**
     * @Route("/api/sync", name="sync", methods={"POST"})
     */
    public function sync(Request $request, Connection $connection): JsonResponse
    {
        // Get the JSON data
        $jsonData = json_decode($request->getContent(), true);

        // If 'purpose' key is not set in the JSON data, return a bad request response
        // testing
        // testing 2
        if (!isset($jsonData['purpose'])) {
            return $this->json([
                'status' => 0,
                'msg' => 'Bad Request! Could not process request.',
            ]);
        }

        // Switch based on the 'purpose' value to call different methods
        switch ($jsonData['purpose']) {
            case 'download':
                return $this->download($connection, $jsonData);
                break;

            case 'upload':
                return $this->upload($connection, $jsonData);
                break;

            default:
                return $this->json([
                    'status' => 0,
                    'msg' => 'Bad Request! Could not process request.',
                ]);
                break;
        }
    }

    // Download Server Data to Local
    public function download(Connection $connection, $jsonData): JsonResponse
    {
        // Get the JSON data
        $id = $jsonData['id'];

        if (!$id) {
            return $this->json([
                'status' => 0,
                'msg' => 'Bad Request! Could not process request.',
            ]);
        }

        // Fetch data from auth_users table
        $userData = $connection->createQueryBuilder()
            ->select('country_id', 'region_id', 'district_id', 'ward_id')
            ->from('auth_users')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->execute()
            ->fetchAssociative();

        if (!$userData) {
            return $this->json([
                'status' => 0,
                'msg' => 'User data not found.',
            ]);
        }

        $countryId = $userData['country_id'];
        $regionId = $userData['region_id'];
        $districtId = $userData['district_id'];
        $wardId = $userData['ward_id'];

        $tables = [
            'mob_form' => 'id',
            'mob_form_field' => 'field_id',
            'mob_form_field_multiple' => 'multi_id',
            'core_country' => 'id',
            'country_units' => 'id',
            'core_master_list_type' => 'id',
            'core_master_list' => 'id',
            'core_farm' => 'id',
            'core_animal' => 'id',
            'core_animal_herd' => 'id',
            'core_cooperative_group' => 'id',
            'breed_matrix' => 'id'
        ];

        $structure = $records = [];

        foreach ($tables as $table => $pk) {
            // Get table structure
            $fields = $connection->query("SHOW COLUMNS FROM " . $table)->fetchAll();
            foreach ($fields as $key => $field) {
                if ($fields[$key]['Field'] == $pk) {
                    if (strpos($fields[$key]['Type'], 'int') !== false) {
                        $fields[$key] = $fields[$key]['Field'] . ' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL';
                    } else {
                        $fields[$key] = $fields[$key]['Field'] . ' TEXT PRIMARY KEY NOT NULL';
                    }
                } else {
                    if (strpos($fields[$key]['Type'], 'int') !== false) {
                        $fields[$key] = $fields[$key]['Field'] . ' INTEGER NULL DEFAULT NULL';
                    } else {
                        $fields[$key] = $fields[$key]['Field'] . ' TEXT NULL DEFAULT NULL';
                    }
                }
            }
            $structure[$table] = '(' . implode(', ', $fields) . ')';

            if ($table === 'core_country') {
                // Fetch data from core_country table where id matches $countryId
                $query = $connection->createQueryBuilder()
                    ->select('*')
                    ->from($table)
                    ->where('id = :countryId')
                    ->setParameter('countryId', $countryId)
                    ->execute();
                $records[$table] = $query->fetchAllAssociative();
            } else if ($table === 'country_units') {
                $queryResults = [];

                // Fetch data for region, district, ward, and village
                $regionQuery = $connection->createQueryBuilder()
                    ->select('*')
                    ->from('country_units')
                    ->where('id = :regionId')
                    ->setParameter('regionId', $regionId)
                    ->execute();
                $queryResults['region'] = $regionQuery->fetchAllAssociative();

                $districtQuery = $connection->createQueryBuilder()
                    ->select('*')
                    ->from('country_units')
                    ->where('id = :districtId')
                    ->setParameter('districtId', $districtId)
                    ->execute();
                $queryResults['district'] = $districtQuery->fetchAllAssociative();

                $wardQuery = $connection->createQueryBuilder()
                    ->select('*')
                    ->from('country_units')
                    ->where('parent_id = :districtId')
                    ->setParameter('districtId', $districtId)
                    ->execute();
                $queryResults['ward'] = $wardQuery->fetchAllAssociative();

                // Fetch data for villages within each ward
                foreach ($queryResults['ward'] as $ward) {
                    $wardId = $ward['id'];

                    $villageQuery = $connection->createQueryBuilder()
                        ->select('*')
                        ->from('country_units')
                        ->where('parent_id = :wardId')
                        ->setParameter('wardId', $wardId)
                        ->execute();
                    $queryResults['village'][$wardId] = $villageQuery->fetchAllAssociative();
                }

                // Flatten the hierarchy data into a single array of objects
                $flattenedData = array_merge(
                    $queryResults['region'],
                    $queryResults['district'],
                    $queryResults['ward'],
                    ...array_values($queryResults['village'])
                );

                // Assign the flattened data to the 'country_units' key in the $records array
                $records[$table] = $flattenedData;
            }else if (in_array($table, ['core_farm', 'core_animal', 'core_animal_herd'])) {
                $query = $connection->createQueryBuilder()
                    ->select('*')
                    ->from($table)
                    ->where('country_id = :countryId')
                    ->andWhere('region_id = :regionId')
                    ->andWhere('district_id = :districtId')
                    ->orderBy($pk)
                    ->setParameters([
                        'countryId' => $countryId,
                        'regionId' => $regionId,
                        'districtId' => $districtId,
                    ])
                    ->execute();
                $records[$table] = $query->fetchAllAssociative();
            } else {
                $query = $connection->createQueryBuilder()
                    ->select('*')
                    ->from($table)
                    ->orderBy($pk)
                    ->execute();
                $records[$table] = $query->fetchAllAssociative();
            }

        }

        $return = [
            'status' => 1,
            'records' => $records,
            'structure' => $structure,
        ];

        return $this->json($return);
    }

    public function upload(Connection $connection, $jsonData): JsonResponse
    {
        date_default_timezone_set("UTC");
        $queries = $jsonData['queries'];
        foreach ($queries as $query) {
            $data = (array) json_decode($query['data']); // Use object syntax here
            switch ($query['type']) { // Use object syntax here
                case 'query':
                    switch ($query['action']) { // Use object syntax here
                        case 'insert':
                            // Create the column names and values for the INSERT query
                            $columns = [];
                            $values = [];

                            foreach ($data['data'] as $column => $value) {
                                $columns[] = $column;
                                $values[] = "'" . $value . "'";
                            }

                            $columns = implode(', ', $columns);
                            $values = implode(', ', $values);

                            // Create the INSERT query
                            $sql = "INSERT INTO " . $data['tablename'] . " ($columns) VALUES ($values)";
                            $connection->query($sql); // Execute the query
                            break;
                    }
                    // Insert into query table
                    $sql = "INSERT INTO query (type, action, time, creator, platform, data) VALUES ('" . $query['type'] . "', '" . $query['action'] . "', '" . $query['time'] . "', '" . $query['creator'] . "', 'mobile', '" . $query['data'] . "')";
                    $connection->query($sql); // Execute the query
                    break;

                case 'surveyimage':
                    switch ($query['action']) {
                        case 'insert':
                            //Insert into survey table
                            // Create the column names and values for the INSERT query
                            $columns = [];
                            $values = [];

                            foreach ($data['data'] as $column => $value) {
                                $columns[] = $column;
                                $values[] = "'" . $value . "'";
                            }

                            $columns = implode(', ', $columns);
                            $values = implode(', ', $values);

                            // Create the INSERT query
                            $sql = "INSERT INTO " . $data['table_name'] . " ($columns) VALUES ($values)";
                            $connection->query($sql);
                            break;
                    }

                    // Insert into query table
                    $sql = "INSERT INTO query (type, action, time, creator, platform, data) VALUES ('" . $query['type'] . "', '" . $query['action'] . "', '" . $query['time'] . "', '" . $query['creator'] . "', 'mobile', '" . $query['data'] . "')";
                    $connection->query($sql); // Execute the query
                    break;
            }
        }

        // Step 1: Select data_id from core_animal_herd_copy table
        /*$query1 = "SELECT farm_id FROM core_animal_herd_copy WHERE farmid IS NULL";
        $result1 = $connection->query($query1);

        if ($result1) {
            $data1 = $result1->fetchAll(); // Correctly fetch data
            foreach ($data1 as $row1) {
                $farm_id = $row1['farm_id'];

                // Step 2: Select id from core_farm_copy table using data_id
                $query2 = "SELECT id FROM core_farm_copy WHERE data_id = '".$farm_id."'";
                $result2 = $connection->query($query2);

                if ($result2) {
                    $data2 = $result2->fetchAll(); // Correctly fetch data
                    foreach ($data2 as $row2) {
                        $updateid = $row2['id'];
                        // Step 3: Update core_animal_herd_copy table with farm_id
                        $query3 = "UPDATE core_animal_herd_copy SET farmid = $updateid WHERE farm_id = '".$farm_id."'";
                        $connection->query($query3);
                    }
                }
            }
        }*/

        return $this->json([
            'msg' => 'Successfully synced LocalDB with remoteDB.',
            'status' => 1
        ]);
    }


    /**
     * @Route("/api/upload_file_new", name="app_syncimage", methods={"POST"})
     */
    public function upload_file_new()
    {
        date_default_timezone_set("UTC");
        if (!defined('UPLOAD_DIR')) {
            define('UPLOAD_DIR', 'survey/');
        }

        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            return $this->json([
                'msg' => 'Error uploading file.',
                'status' => 0
            ]);
        }

        $uploadPath = UPLOAD_DIR . $_FILES['file']['name'];

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
            return $this->json([
                'msg' => 'Error moving uploaded file.',
                'status' => 0
            ]);
        }

        return $this->json([
            'msg' => 'Successfully uploaded file to server.',
            'status' => 1
        ]);
    }

}