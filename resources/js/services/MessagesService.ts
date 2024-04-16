import axios from "axios";

import { IMessages, IMessageReport } from "@/interface/Messages";

export default class MessagesService {

    public static async sendMessage(content: string, themeId: number): Promise<IMessages> {
        return await axios.post(`/messages`, { content, theme_id: themeId });
    }

    public static async toggleLike(id: number): Promise<void> {
        return await axios.post(`/messages/${id}/likes`)
    }

    public static async complaint({ id, theme_id, body }: IMessageReport): Promise<void> {
        return await axios.post(`/messages/${id}/complaints`, { theme_id, body });
    }
}


