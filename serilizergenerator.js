"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (g && (g = 0, op[0] && (_ = 0)), _) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
Object.defineProperty(exports, "__esModule", { value: true });
var readline = require("readline");
var fs = require("fs");
function generateSerializerYaml(entityClass, properties) {
    var template = "".concat(entityClass, ":");
    for (var _i = 0, properties_1 = properties; _i < properties_1.length; _i++) {
        var prop = properties_1[_i];
        template += "\n    ".concat(prop, ":");
        template += "\n        groups: [";
        template += "\n            \"".concat(entityClass.toLowerCase(), ":collection:get\",");
        template += "\n            \"".concat(entityClass.toLowerCase(), ":collection:post\",");
        template += "\n            \"".concat(entityClass.toLowerCase(), ":item:get\",");
        template += "\n            \"".concat(entityClass.toLowerCase(), ":item:put\",");
        template += "\n            \"".concat(entityClass.toLowerCase(), ":item:patch\"");
        template += "\n        ]";
    }
    return template;
}
function main() {
    return __awaiter(this, void 0, void 0, function () {
        var rl, entityClass, properties, prop, serializerYamlContent, entityName, serializerFileName, location, filePath;
        return __generator(this, function (_a) {
            switch (_a.label) {
                case 0:
                    rl = readline.createInterface({
                        input: process.stdin,
                        output: process.stdout,
                    });
                    return [4 /*yield*/, getInput(rl, "Enter the fully qualified entity class name (e.g., App\\Entity\\Animal): ")];
                case 1:
                    entityClass = _a.sent();
                    properties = [];
                    _a.label = 2;
                case 2:
                    if (!true) return [3 /*break*/, 4];
                    return [4 /*yield*/, getInput(rl, "Enter a property name (or 'done' to finish): ")];
                case 3:
                    prop = _a.sent();
                    if (prop.toLowerCase() === "done") {
                        return [3 /*break*/, 4];
                    }
                    properties.push(prop);
                    return [3 /*break*/, 2];
                case 4:
                    serializerYamlContent = generateSerializerYaml(entityClass, properties);
                    entityName = entityClass.split('\\').pop();
                    serializerFileName = entityName.toLowerCase() + ".yaml";
                    return [4 /*yield*/, getInput(rl, "Enter the location to save the serializer file (e.g., /path/to/directory/): ")];
                case 5:
                    location = _a.sent();
                    filePath = location + serializerFileName;
                    fs.writeFileSync(filePath, serializerYamlContent);
                    console.log("serializer.yaml has been generated and saved at ".concat(filePath));
                    rl.close();
                    return [2 /*return*/];
            }
        });
    });
}
function getInput(rl, prompt) {
    return new Promise(function (resolve) {
        rl.question(prompt, function (input) {
            resolve(input);
        });
    });
}
main().catch(function (err) {
    console.error("Error occurred:", err);
});
