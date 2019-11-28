//
// Copyright © 2019 NightOwl Labs
//
import { Feline } from './feline';

export class Scanner {
    constructor(private feline: Feline, private code: string) {}

    scanTokens() {
        return ['tok1', 'tok2', 'tok3'];
    }
}
