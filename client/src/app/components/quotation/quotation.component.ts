import { Component, OnInit, signal } from '@angular/core';
import {
  FormGroup,
  FormControl,
  ReactiveFormsModule,
  FormArray,
  Validators,
} from '@angular/forms';

import { Currencies, CurrencyService } from '../../_services/currency.service';
import { Quotation, QuotationService } from '../../_services/quotation.service';

@Component({
  selector: 'app-quotation',
  templateUrl: './quotation.component.html',
  imports: [ReactiveFormsModule],
})
export class QuotationComponent implements OnInit {
  public currencies = signal<Currencies>({ data: [] });
  public quotation = signal<Quotation | null>(null);
  public formError = signal<string>('');

  public quotationForm = new FormGroup({
    ages: new FormArray(
      [
        new FormControl('28', [Validators.required]),
        new FormControl('35', [Validators.required]),
      ],
      [Validators.required]
    ),
    currency_id: new FormControl('EUR', [Validators.required]),
    start_date: new FormControl('2020-10-01', [Validators.required]),
    end_date: new FormControl('2020-10-30', [Validators.required]),
  });

  constructor(
    private currencyService: CurrencyService,
    private quotationService: QuotationService
  ) {}

  ngOnInit() {
    this.currencyService.currencies().subscribe({
      next: (data) => {
        this.currencies.set(data);

        if (data.data.length > 0) {
          this.quotationForm.patchValue({
            currency_id: data.data[0].id,
          });
        }
      },
      error: (error) => console.error(error),
    });
  }

  get ages(): FormArray {
    return this.quotationForm.get('ages') as FormArray;
  }

  get currency() {
    return this.quotationForm.get('currency_id');
  }

  get startDate() {
    return this.quotationForm.get('start_date');
  }

  get endDate() {
    return this.quotationForm.get('end_date');
  }

  addAge() {
    this.ages.push(new FormControl('', [Validators.required]));
  }

  removeAge(index: number) {
    this.ages.removeAt(index);
  }

  onSubmit() {
    if (this.quotationForm.valid) {
      const { ages, currency_id, start_date, end_date } =
        this.quotationForm.value;
      const age = ages?.join(',');

      this.quotationService
        .quotation(age, currency_id, start_date, end_date)
        .subscribe({
          next: (res) => {
            this.quotation.set(res);
            this.formError.set('');
          },
          error: (error) => {
            this.formError.set(error.error.message);
          },
        });
    }
  }
}
