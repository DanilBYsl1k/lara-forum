import axios from "axios";

export default class UserService {

    public static async userAvatar(formData: FormData): Promise<{ data: { avatar: string } }> {
        return await axios.post('/users/avatar', formData);
    }
}
