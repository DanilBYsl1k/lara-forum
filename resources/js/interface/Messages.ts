import { IUser } from "@/interface/User";

export interface IMessages {
    content: string;
    id: number;
    theme_id: number;
    time: string;
    user: IUser;
    is_liked: boolean;
    likes: number;
    is_not_solved_complaint: boolean;
}

export interface IMessageReport extends IMessages {
    body: string;
}
