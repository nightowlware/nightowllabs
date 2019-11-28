
import * as repl from 'repl';
import { callbackify } from 'util';

export class Feline {

    runRepl() {
        console.log("TODO: run the repl!");

        const evaluator = (cmd, ctx, filename, cb) => {
            console.log('cmd =', cmd);
            console.log('filename = ', filename);
            console.log('message =', ctx.msg);
            cb(null, 'Test!');
        }

        const msg = 'hey there';
        repl.start({ prompt: '> ', eval: evaluator}).context.msg = msg;

    }

}
