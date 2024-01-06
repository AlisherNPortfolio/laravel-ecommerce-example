import { ILogin, ILoginResponse } from "../../contracts/pages/IAuth";
import ISuccessResponse from "../../contracts/responses/ISuccessResponse";
import http from '../../http-common'

class AuthService {
    private url = '/api/admin/auth';

    login(form: ILogin): Promise<ISuccessResponse<ILoginResponse>> {
        return http.post(`${this.url}/login`, form)
        .then(res => res.data);
    }
}

export default new AuthService();
