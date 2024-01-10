<?php
// src/Controller/SyncController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * @Route("/api/docs")
 */
class SyncController extends AbstractController
{
    /**
     * @var int The identifier for the resource
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @Route("/sync", name="sync", methods={"POST"})
     */
    public function sync(Request $request, Connection $connection): JsonResponse
    {
        // Get the JSON data
        $jsonData = json_decode($request->getContent(), true);

        // If 'purpose' key is not set in the JSON data, return a bad request response
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

    // Token validation method using LexikJWTAuthenticationBundle
//    private function validateToken($token)
//    {
//        // Retrieve the JWT manager service
//        $jwtManager = $this->get(JWTTokenManagerInterface::class);
//
//        // Extract the token from the Authorization header
//        $extractor = new AuthorizationHeaderTokenExtractor(
//            'Bearer',
//            'Authorization'
//        );
//
//        // Try to extract the token from the request
//        try {
//            $extractedToken = $extractor->extract($this->getRequest());
//            $jwtToken = $extractedToken ?: $token;
//        } catch (\Throwable $e) {
//            throw new AccessDeniedException('Invalid token David');
//        }
//
//        // Validate the token
//        try {
//            $decodedToken = $jwtManager->decode($jwtToken);
//            // If the token is valid, return true
//            return true;
//        } catch (\Throwable $e) {
//            throw new AccessDeniedException('Invalid token David 1');
//        }
//    }

    // Download Mobile Data to Local
    public function download(Request $request, Connection $connection): JsonResponse
    {
        try {
//            // Get the JSON data
            $jsonData = json_decode($request->getContent(), true);

            var_dump($jsonData);
//            die();

            if (!isset($jsonData['id'])) {
                return $this->json([
                    'status' => 0,
                    'msg' => 'Bad Request! "id" is missing in the request.',
                ]);
            }

            if (!isset($jsonData['token'])) {
                return $this->json([
                    'status' => 0,
                    'msg' => 'Bad Request! "token" is missing in the request.',
                ]);
            }


//            // Validate or verify the token (This depends on your token validation method)
//            $isValidToken = $this->validateToken($jsonData['token']);
//
//            if (!$isValidToken) {
//                return $this->json([
//                    'status' => 0,
//                    'msg' => 'Invalid Token. Access Denied.',
//                ]);
//            }

            // Continue with the download process if the token is valid
            // Get the JSON data
            $id = $jsonData['id'];

            var_dump($id);

            if (!$id) {
                return $this->json([
                    'status' => 0,
                    'msg' => 'Bad Request! Could not process request.',
                ]);
            }
            // Fetch data from auth_users table
            $userDataQuery = $connection->createQueryBuilder()
                ->select('country_id', 'region_id', 'district_id', 'ward_id')
                ->from('auth_users')
                ->where('id = :id')
                ->setParameter('id', $id, Types::INTEGER)
                ->execute();

            $userData = $userDataQuery->fetchAssociative();

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
                'form' => 'id',
                'form_field' => 'field_id',
                'form_field_multiple' => 'multi_id',
                'core_country' => 'id',
                'country_units' => 'id',
                'core_master_list_type' => 'id',
                'core_master_list' => 'id',
                'core_farm_copy' => 'id',
                'core_animal_copy' => 'id',
                'core_animal_herd_copy' => 'id',
                'survey13' => 'id',
                'survey22' => 'id',
                'breed_matrix' => 'id',
            ];

            $structure = $records = [];

            foreach ($tables as $table => $pk) {
                // Get table structure
                $fields = $connection->executeQuery("SHOW COLUMNS FROM $table")->fetchAllAssociative();
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
                        ->setParameter('countryId', $countryId, Types::INTEGER)
                        ->execute();
                    $records[$table] = $query->fetchAllAssociative();
                } else if ($table === 'country_units') {
                    $queryResults = [];
                    // Fetch data for region, district, ward, and village
                    $regionQuery = $connection->createQueryBuilder()
                        ->select('*')
                        ->from('country_units')
                        ->where('id = :regionId')
                        ->setParameter('regionId', $regionId, Types::INTEGER)
                        ->execute();
                    $queryResults['region'] = $regionQuery->fetchAllAssociative();

                    $districtQuery = $connection->createQueryBuilder()
                        ->select('*')
                        ->from('country_units')
                        ->where('id = :districtId')
                        ->setParameter('districtId', $districtId, Types::INTEGER)
                        ->execute();
                    $queryResults['district'] = $districtQuery->fetchAllAssociative();

                    $wardQuery = $connection->createQueryBuilder()
                        ->select('*')
                        ->from('country_units')
                        ->where('parent_id = :districtId')
                        ->setParameter('districtId', $districtId, Types::INTEGER)
                        ->execute();
                    $queryResults['ward'] = $wardQuery->fetchAllAssociative();

                    // Fetch data for villages within each ward
                    foreach ($queryResults['ward'] as $ward) {
                        $wardId = $ward['id'];

                        $villageQuery = $connection->createQueryBuilder()
                            ->select('*')
                            ->from('country_units')
                            ->where('parent_id = :wardId')
                            ->setParameter('wardId', $wardId, Types::INTEGER)
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
                } else if (in_array($table, ['core_farm_copy', 'core_animal_copy', 'core_animal_herd_copy'])) {
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
                        ], [
                            'countryId' => Types::INTEGER,
                            'regionId' => Types::INTEGER,
                            'districtId' => Types::INTEGER,
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
        } catch (Exception $e) {
            return $this->json([
                'status' => 0,
                'msg' => 'An error occurred while processing the request.',
            ]);
        }

    }

    public function upload(Connection $connection, $jsonData): JsonResponse
    {
        date_default_timezone_set("UTC");
        $queries = $jsonData['queries'];
        try {
            foreach ($queries as $query) {
                $data = (array)json_decode($query['data']); // Use object syntax here
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
                                $connection->executeQuery($sql); // Execute the query
                                break;
                        }

                        // Insert into query table
                        $sql = "INSERT INTO query (type, action, time, creator, platform, data) VALUES (:type, :action, :time, :creator, 'mobile', :data)";
                        $connection->executeQuery($sql, [
                            'type' => $query['type'],
                            'action' => $query['action'],
                            'time' => $query['time'],
                            'creator' => $query['creator'],
                            'data' => $query['data'],
                        ], [
                            'type' => Types::STRING,
                            'action' => Types::STRING,
                            'time' => Types::STRING,
                            'creator' => Types::STRING,
                            'data' => Types::STRING,
                        ]);
                        break;

                    case 'surveyimage':
                        switch ($query['action']) {
                            case 'insert':
                                // Insert into survey table
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
                                $connection->executeQuery($sql);
                                break;
                        }

                        // Insert into query table
                        $sql = "INSERT INTO query (type, action, time, creator, platform, data) VALUES (:type, :action, :time, :creator, 'mobile', :data)";
                        $connection->executeQuery($sql, [
                            'type' => $query['type'],
                            'action' => $query['action'],
                            'time' => $query['time'],
                            'creator' => $query['creator'],
                            'data' => $query['data'],
                        ], [
                            'type' => Types::STRING,
                            'action' => Types::STRING,
                            'time' => Types::STRING,
                            'creator' => Types::STRING,
                            'data' => Types::STRING,
                        ]);
                        break;
                }
            }

            return $this->json([
                'msg' => 'Successfully synced LocalDB with remoteDB.',
                'status' => 1,
            ]);
        } catch (Exception $e) {
            return $this->json([
                'status' => 0,
                'msg' => 'An error occurred while processing the request.',
            ]);
        }
    }

    /**
     * @Route("/upload-file", name="upload_file", methods={"POST"})
     */
    public function uploadFileNew(Request $request): JsonResponse
    {
        date_default_timezone_set("UTC");
        if (!defined('UPLOAD_DIR')) {
            define('UPLOAD_DIR', 'survey/');
        }

        $file = $request->files->get('file');
        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
            return $this->json([
                'msg' => 'Error uploading file.',
                'status' => 0,
            ]);
        }

        $uploadPath = UPLOAD_DIR . $file->getClientOriginalName();

        try {
            $file->move($uploadPath);

            return $this->json([
                'msg' => 'Successfully uploaded file to server.',
                'status' => 1,
            ]);
        } catch (Exception $e) {
            return $this->json([
                'msg' => 'Error moving uploaded file.',
                'status' => 0,
            ]);
        }
    }
}
