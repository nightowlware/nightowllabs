import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SheetsService {
  private chemicalsSheetUrl =
    'https://sheets.googleapis.com/v4/spreadsheets/1V0enEoxAVnOcziwCy1Qq8WN4IT3vP8lwKeaE8xtdJ8A/values/Chemicals?key=AIzaSyATd93dzBnGM7VqSzhrhIellwuWN2pG-Zw';

  constructor(private http: HttpClient) {}

  getChemicalsSheet() {
    return this.http.get<Sheet>(this.chemicalsSheetUrl);
  }

  getChemicals(): Observable<SheetRow[]> {
    return this.getChemicalsSheet().pipe(map(sheet => sheet.values));
  }
}

export interface Sheet {
  range: string;
  majorDimension: string;
  values: [[string]];
}

export type SheetRow = [string];
