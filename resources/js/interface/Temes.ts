import { IMainParams } from "./MainParams";
import { IMessages } from "@/interface/Messages";

export interface IThemes extends IMainParams{
    branch_id: number
    description: string;
    messages: IMessages[];
}
