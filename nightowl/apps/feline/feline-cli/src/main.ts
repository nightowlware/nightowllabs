import { Feline } from "./app/feline";

function main() {
    console.log('Feline CLI v0.0.2');

    const f = new Feline();
    f.runRepl();
}
main();
