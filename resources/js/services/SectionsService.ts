import axios from "axios";
import { router } from "@inertiajs/vue3";

import { IBranchInterface } from "@/interface/BranchInterface";

export default class SectionsService {

    public static async getBranches(sectionId: number | null): Promise<IBranchInterface> {
        return await axios.get(`/sections/${sectionId}/branches`);
    }

    public static async getBranchesExcept(sectionId: number, branchId: number): Promise<IBranchInterface> {
        return await axios.get(`/sections/${sectionId}/branches_except/${branchId}`);
    }

    public static storeSection(sectionId: number, title: string): void {
        router.patch(`/sections/${sectionId}`, { title });
    }

    public static CreateSection(title: string): void {
        router.post('/sections', { title });
    }
}
