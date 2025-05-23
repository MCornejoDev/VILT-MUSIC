import { Album } from "./album"

export interface Single {
    id: number
    title: string
    duration: number
    file: string
    album_id: number
    album: Album
    created_at: string
    updated_at: string
}
