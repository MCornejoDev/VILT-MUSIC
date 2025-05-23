export interface PaginationLinks {
    url: string | null;
    label: string;
    active: boolean;
}

export interface PaginatorMeta {
    current_page: number;
    from: number;
    last_page: number;
    links: PaginationLinks[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

export interface Paginated<T> {
    data: T[];
    meta: PaginatorMeta;
}
