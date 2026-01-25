import { http } from '@/api/http'
import type { AgencyDTO } from '@/domains/agencies/dtos/AgencyDTO'

export interface PaginatedAgencies {
  data: AgencyDTO[]
  meta: {
    current_page: number
    per_page: number
    total: number
    last_page: number
  }
}

export class AgencyService {
  static async getAgencies(page = 1, perPage = 5): Promise<PaginatedAgencies> {
    return http.get<PaginatedAgencies>('/agencies', {
      params: { page: page, perpage: perPage },
    } as any)
  }

  static async getAgency(id: number): Promise<AgencyDTO> {
    return http.get<AgencyDTO>(`/agencies/${id}`)
  }

  static async createAgency(payload: Partial<AgencyDTO>): Promise<AgencyDTO> {
    return http.post<AgencyDTO>('/agencies', payload)
  }

  static async updateAgency(id: number, payload: Partial<AgencyDTO>): Promise<AgencyDTO> {
    return http.put<AgencyDTO>(`/agencies/${id}`, payload)
  }

  static async deleteAgency(id: number): Promise<void> {
    return http.delete(`/agencies/${id}`)
  }
}
