export interface Task {
    id: number
    title: string
    description: string | null
    status: 'not-started' | 'in-progress' | 'completed' | 'on-hold'
}