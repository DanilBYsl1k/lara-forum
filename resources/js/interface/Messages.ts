import { IUser } from "@/interface/User";

export interface IMessages {
    content: string;
    id: number;
    theme_id: number;
    time: string;
    user: IUser
}
