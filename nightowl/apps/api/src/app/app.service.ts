import { Injectable, HttpService } from '@nestjs/common';
import { AxiosResponse } from 'axios';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class AppService {
  constructor(private readonly http: HttpService) {}

  getData(): Observable<AxiosResponse<any>> {
    const apiKey = 'AIzaSyATd93dzBnGM7VqSzhrhIellwuWN2pG-Zw';
    const sheetId = '1V0enEoxAVnOcziwCy1Qq8WN4IT3vP8lwKeaE8xtdJ8A';

    const url = `https://sheets.googleapis.com/v4/spreadsheets/${sheetId}/values/Chemicals?key=${apiKey}`;
    return this.http.get(url).pipe(map(res => res.data));
  }
}
