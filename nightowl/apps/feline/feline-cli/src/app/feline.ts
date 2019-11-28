
import * as repl from 'repl';

export class Feline {

    runRepl() {
        const evaluator = (cmd: string, ctx: any, filename: string, cb: any) => {
            const value = this.run(cmd);
            cb(null, value); //TODO: read up on how this callback works...
        }

        const msg = 'some data for the context';

        repl.start({ prompt: '> ', eval: evaluator}).context.msg = msg;
    }

    run(code: string) : any {
        return "TODO: Run the code!";
    }

}
