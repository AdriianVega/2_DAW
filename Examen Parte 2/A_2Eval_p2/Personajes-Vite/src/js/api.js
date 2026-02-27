import { personajes } from "personajes.js";

const db = await openDB("app-db", 1, {
    upgrade(db) {
        db.createObjectStore("users", { keyPath: "id"});
    }
});

await db.put("users", {id: 1, name: "Ana"})
const user = await db.get("users", 1);