import { Injectable, HttpService, Logger } from '@nestjs/common';
import { AxiosResponse } from 'axios';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class AppService {
  constructor(private readonly http: HttpService) {}

  getData(): Observable<AxiosResponse<any>> {
    const apiKey = process.env.API_GOOGLE_SHEETS_KEY;
    const sheetId = process.env.API_GOOGLE_SHEETS_ID;

    const url = `https://sheets.googleapis.com/v4/spreadsheets/${sheetId}/values/Chemicals?key=${apiKey}`;
    return this.http.get(url).pipe(map(res => res.data));
  }
}
