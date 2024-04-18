import { router } from "@inertiajs/vue3";

export default class ThemeService {
    public static updateTheme(themeId: number, data: {title: string, description: string}): void {
        router.patch(`/themes/${themeId}`, data );
    }

    public static CreateTheme(data: { title: string, description: string, branch_id: number}): void {
        router.post('/themes', data);
    }
}
