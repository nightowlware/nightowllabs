import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';
import { environment as env } from '../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SheetsService {
  constructor(private http: HttpClient) {}

  getChemicalsSheet() {
    return this.http.get<Sheet>(env.apiUrl);
  }

  getChemicals(): Observable<SheetRow[]> {
    return this.getChemicalsSheet().pipe(
      map(sheet => sheet.values.slice(1).sort())
    );
  }

  getHeadings(): Observable<SheetRow> {
    return this.getChemicalsSheet().pipe(map(sheet => sheet.values[0]));
  }
}

export interface Sheet {
  range: string;
  majorDimension: string;
  values: string[][];
}

export type SheetRow = string[];

// TODO: make this a stronger type.
export type Chemical = SheetRow;

export enum HeadingsEnum {
  ChemicalName,
  Dose,
  Risk,
  PersonalRating,
  Mechanism,
  Opinion
}
