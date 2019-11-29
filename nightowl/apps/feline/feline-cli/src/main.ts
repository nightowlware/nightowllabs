//
// Copyright © 2019 NightOwl Labs
//
import { Feline } from "./app/feline";

function main() {
    console.log('\nFeline CLI v0.0.2');

    const f = new Feline();
    f.runRepl();
}
main();
