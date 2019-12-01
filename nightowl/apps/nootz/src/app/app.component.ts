import { interval } from 'rxjs';
import { switchMap } from 'rxjs/operators';
import { Component, OnInit } from '@angular/core';
import { SheetsService, Sheet, SheetRow } from './sheets.service';

@Component({
  selector: 'nootz-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  title = 'nootz';

  chemicals: SheetRow[] = [['']];
  headings: SheetRow = [''];

  searchText: string;

  constructor(private sheetsService: SheetsService) {}

  ngOnInit() {
    this.sheetsService
      .getChemicals()
      .subscribe(data => (this.chemicals = data));

    // refresh data regularly
    interval(10000)
      .pipe(switchMap(() => this.sheetsService.getChemicals()))
      .subscribe(data => (this.chemicals = data));

    this.sheetsService.getHeadings().subscribe(data => (this.headings = data));
  }

  trackByFunction(index: any, item: any[]) {
    return item[0];
  }
}
