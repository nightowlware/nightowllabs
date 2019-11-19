import {
  Injectable,
  HttpService,
  Logger,
  HttpException,
  HttpStatus
} from '@nestjs/common';
import { AxiosResponse } from 'axios';
import { Observable } from 'rxjs';
import { map, catchError } from 'rxjs/operators';

@Injectable()
export class AppService {
  constructor(private readonly http: HttpService) {}

  getData(): Observable<AxiosResponse<any>> {
    const apiKey = process.env.API_GOOGLE_SHEETS_KEY;
    const sheetId = process.env.API_GOOGLE_SHEETS_ID;

    const url = `https://sheets.googleapis.com/v4/spreadsheets/${sheetId}/values/Chemicals?key=${apiKey}`;
    return this.http
      .get(url)
      .pipe(catchError(this.handleGoogleSheetsError))
      .pipe(map(res => res.data));
  }

  handleGoogleSheetsError(e): never {
    const msg = 'Could not read from the GoogleSheets API';
    Logger.error(msg);
    throw new HttpException(msg, HttpStatus.INTERNAL_SERVER_ERROR);
  }
}
