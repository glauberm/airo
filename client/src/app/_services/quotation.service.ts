import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { BASE_API_URI } from '../app.config';

export interface Quotation {
  data: {
    total: number;
    currency_id: number;
    quotation_id: number;
  };
}

@Injectable({
  providedIn: 'root',
})
export class QuotationService {
  constructor(private http: HttpClient) {}

  quotation(
    age: string | null | undefined,
    currency_id: string | null | undefined,
    start_date: string | null | undefined,
    end_date: string | null | undefined
  ): Observable<Quotation> {
    return this.http.post<Quotation>(BASE_API_URI + 'quotation', {
      age,
      currency_id,
      start_date,
      end_date,
    });
  }
}
