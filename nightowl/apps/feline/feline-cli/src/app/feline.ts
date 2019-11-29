//
// Copyright © 2019 NightOwl Labs
//
import * as repl from 'repl';
import { Scanner } from './scanner';

export class Feline {

    private debug = {
        tokens: true
    };

    runRepl() {
        const evaluator = (cmd: string, ctx: any, filename: string, cb: any) => {
            const value = this.run(cmd);
            cb(null, value); //TODO: read up on how this callback works...
        }

        const msg = 'some data for the context'; //TODO: consider how to use this, if helpful...

        repl.start({ prompt: '> ', eval: evaluator}).context.msg = msg;
    }

    run(code: string) : any {
        const scanner = new Scanner(this, code);
        const tokens: any = scanner.scanTokens();

        if (this.debug.tokens) {
            console.log('== DEBUG: TOKENS ================================');
            for (const t of tokens) {
                console.log(t);
            }
            console.log('=================================================');
        }

        return "TODO: result value";
    }

}
