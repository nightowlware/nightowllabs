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
import { InjectRepository } from '@nestjs/typeorm';
import { TypeOrmCrudService } from '@nestjsx/crud-typeorm';
import { Interaction } from '../models/interaction.entity';
import { Repository } from 'typeorm';

@Injectable()
export class AppService extends TypeOrmCrudService<Interaction> {
  constructor(
    private readonly http: HttpService,

    @InjectRepository(Interaction)
    private readonly interactionsRepo: Repository<Interaction>
  ) {
    super(interactionsRepo);
  }

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

  getAllInteractions(): Promise<Interaction[]> {
    return this.interactionsRepo.find();
  }

  saveInteraction(): Promise<Interaction> {
    const o = new Interaction();
    o.chemical = 'Adderall';
    o.details = 'Test details';
    return this.interactionsRepo.save(o);
  }
}
