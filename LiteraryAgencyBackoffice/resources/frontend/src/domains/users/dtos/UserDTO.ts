export class UserDTO {
  id: number
  name: string
  email: string
  avatarUrl?: string

  constructor(id: number, name: string, email: string, avatarUrl?: string) {
    this.id = id
    this.name = name
    this.email = email
    this.avatarUrl = avatarUrl
  }
}
