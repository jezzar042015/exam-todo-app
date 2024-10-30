export interface Task {
    id: number
    title: string
    description: string | null
    status: StatusOptions
    statusDisplay: string
    created_at: string | null
    updated_at: string | null
}

export type StatusOptions = 'not-started' | 'in-progress' | 'completed' | 'on-hold' 