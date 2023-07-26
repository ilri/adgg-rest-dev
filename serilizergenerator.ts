import * as readline from 'readline';
import * as fs from 'fs';

function generateSerializerYaml(entityClass: string, properties: string[]): string {
    let template = `${entityClass}:`;
    for (const prop of properties) {
        template += `\n    ${prop}:`;
        template += `\n        groups: [`;
        template += `\n            "${entityClass.toLowerCase()}:collection:get",`;
        template += `\n            "${entityClass.toLowerCase()}:collection:post",`;
        template += `\n            "${entityClass.toLowerCase()}:item:get",`;
        template += `\n            "${entityClass.toLowerCase()}:item:put",`;
        template += `\n            "${entityClass.toLowerCase()}:item:patch"`;
        template += `\n        ]`;
    }
    return template;
}

async function main() {
    const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout,
    });

    const entityClass = await getInput(rl, "Enter the fully qualified entity class name (e.g., App\\Entity\\Animal): ");

    const properties: string[] = [];
    while (true) {
        const prop = await getInput(rl, "Enter a property name (or 'done' to finish): ");
        if (prop.toLowerCase() === "done") {
            break;
        }
        properties.push(prop);
    }

    const serializerYamlContent = generateSerializerYaml(entityClass, properties);

    const entityName = entityClass.split('\\').pop()!;
    const serializerFileName = entityName.toLowerCase() + ".yaml";

    const location = await getInput(rl, "Enter the location to save the serializer file (e.g., /path/to/directory/): ");
    const filePath = location + serializerFileName;

    fs.writeFileSync(filePath, serializerYamlContent);

    console.log(`serializer.yaml has been generated and saved at ${filePath}`);

    rl.close();
}

function getInput(rl: readline.Interface, prompt: string): Promise<string> {
    return new Promise((resolve) => {
        rl.question(prompt, (input) => {
            resolve(input);
        });
    });
}

main().catch((err) => {
    console.error("Error occurred:", err);
});
