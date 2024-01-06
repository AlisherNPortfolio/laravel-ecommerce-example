import type IPagination from "./IPagination";

export default interface ISuccessPaginationResponse<T> {
    success: boolean,
    data: IPagination<T>
}
