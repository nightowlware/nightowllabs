import { Component, OnInit, Input } from '@angular/core';
import { Chemical, SheetRow, HeadingsEnum } from '../sheets.service';

@Component({
  selector: 'nootz-chemical-view',
  templateUrl: './chemical-view.component.html',
  styleUrls: ['./chemical-view.component.css']
})
export class ChemicalViewComponent implements OnInit {
  @Input()
  private chemical: Chemical;

  @Input()
  private headings: SheetRow;

  chemicalName: string;
  dose: string;
  risk: string;
  personalRating: string;
  mechanism: string;
  opinion: string;

  constructor() {}

  ngOnInit() {
    this.chemicalName = this.chemical[HeadingsEnum.ChemicalName];
    this.dose = this.chemical[HeadingsEnum.Dose];
    this.risk = this.chemical[HeadingsEnum.Risk];
    this.personalRating = this.chemical[HeadingsEnum.PersonalRating];
    this.mechanism = this.chemical[HeadingsEnum.Mechanism];
    this.opinion = this.chemical[HeadingsEnum.Opinion];
  }

  getRiskClass() {
    const risk = this.risk;
    if (!risk) {
      return;
    }

    return risk.includes('1')
      ? 'low-risk'
      : risk.includes('2')
      ? 'medium-risk'
      : risk.includes('3')
      ? 'high-risk'
      : risk.includes('4')
      ? 'danger-risk'
      : '';
  }
}
