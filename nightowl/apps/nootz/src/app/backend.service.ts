import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment as env } from '../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class BackendService {
  constructor(private http: HttpClient) {}

  postInteraction(chemical: string, details: string) {
    return this.http.post(env.apiUrl + '/interaction', {
      chemical,
      details
    });
  }

  //   getHeadings(): Observable<SheetRow> {
  //   return this.getChemicalsSheet().pipe(map(sheet => sheet.values[0]));
  // }
}
