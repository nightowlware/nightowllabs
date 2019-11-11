import { Component, OnInit, Input } from '@angular/core';
import { Chemical, SheetRow } from '../sheets.service';

@Component({
  selector: 'nootz-chemical-view',
  templateUrl: './chemical-view.component.html',
  styleUrls: ['./chemical-view.component.css']
})
export class ChemicalViewComponent implements OnInit {
  @Input()
  chemical: Chemical;

  @Input()
  headings: SheetRow;

  constructor() {}

  ngOnInit() {}
}
