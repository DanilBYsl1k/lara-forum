import { IMainParams } from "./MainParams";

export interface IBranchInterface extends IMainParams{
    section_id: number;
    parent_id: number;
}

export interface IBranchWithChild extends IBranchInterface {
    children: [IBranchInterface];
}


