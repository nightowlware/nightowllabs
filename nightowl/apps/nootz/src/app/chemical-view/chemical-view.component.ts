import {
  Component,
  OnInit,
  Input,
  OnChanges,
  Output,
  ViewChild,
  ElementRef,
  ChangeDetectorRef
} from '@angular/core';
import { Chemical, SheetRow, HeadingsEnum } from '../sheets.service';
import { EventEmitter } from 'events';

@Component({
  selector: 'nootz-chemical-view',
  templateUrl: './chemical-view.component.html',
  styleUrls: ['./chemical-view.component.css']
})
export class ChemicalViewComponent implements OnInit, OnChanges {
  @Input()
  private chemical: Chemical;

  @Input()
  private headings: SheetRow;

  @ViewChild('detailsRef', { static: false }) detailsElement: ElementRef;

  chemicalName: string;
  dose: string;
  risk: string;
  personalRating: string;
  mechanism: string;
  opinion: string;

  constructor(private changeDetector: ChangeDetectorRef) {}

  ngOnInit() {
    this.chemicalName = this.chemical[HeadingsEnum.ChemicalName];
    this.dose = this.chemical[HeadingsEnum.Dose];
    this.risk = this.chemical[HeadingsEnum.Risk];
    this.personalRating = this.chemical[HeadingsEnum.PersonalRating];
    this.mechanism = this.chemical[HeadingsEnum.Mechanism];
    this.opinion = this.chemical[HeadingsEnum.Opinion];
  }

  ngOnChanges() {
    this.ngOnInit();
  }

  isExpanded() {
    return this.detailsElement.nativeElement.hasAttribute('open');
  }

  getRiskEnglish() {
    return this.risk.split('-').pop();
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

  onClickMe(e: MouseEvent) {
    // We have to "wait" until the next event loop cycle
    // so that the DOM has a chance to update.
    setTimeout(() => {
      console.log(`${this.chemicalName} clicked!`);
      console.log(this.isExpanded());
    });
  }
}
