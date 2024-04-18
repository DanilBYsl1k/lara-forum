import { router } from "@inertiajs/vue3";

import { BranchWithoutId } from "@/interface/BranchInterface";

export default class BranchesService {

    public static updateBranches(branchesId: number, sectionData: BranchWithoutId): void {
        router.patch(`/branches/${branchesId}`, { ...sectionData });
    }

    public static createBranches(data: BranchWithoutId): void {
        router.post('/branches', { ...data });
    }
}
