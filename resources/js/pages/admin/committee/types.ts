export interface Committee {
    id: number;
    name: string;
    parent_id: number | null;
    parent?: Committee | null;
    children?: Committee[];
    children_recursive?: Committee[];
    user?: {
        id: number;
        name: string;
    };
    updater?: {
        id: number;
        name: string;
    };
}
