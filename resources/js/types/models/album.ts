import { Category } from "./category"

export interface Album {
    id: number
    title: string
    artist: string
    description: string | null
    stocks: number
    price: number
    release_date: string
    cover: string
    category_id: number
    category: Category
    created_at: string
    updated_at: string
}
