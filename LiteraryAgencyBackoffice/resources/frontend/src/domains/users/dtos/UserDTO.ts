export class UserDTO {
  id: number
  name: string
  email: string
  avatarFile?: File

  constructor(id: number, name: string, email: string, avatarFile?: File) {
    this.id = id
    this.name = name
    this.email = email
    this.avatarFile = avatarFile
  }
}
