export interface LoginResponseDTO {
  token: string;
  user: {
    id: number;
    name: string;
    email: string;
    avatarFile: string | null;
  };
}
