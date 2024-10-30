export interface Task {
    id: number
    title: string
    description: string | null
    status: 'not-started' | 'in-progress' | 'completed' | 'on-hold'
    created_at: string | null
    updated_at: string | null
}