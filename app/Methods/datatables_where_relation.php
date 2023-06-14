<?php

if (!function_exists('datatables_where_relation')) {
    function datatables_where_relation($query, $request)
    {
        foreach ($request->columns as $column) {
            // search in relation column
            if (str_contains($column['name'], '[R]')) {
                $searchRelation = str_replace("[R]", "", $column['name']);
                $relationName = explode("->", $searchRelation)[0];
                $searchColumn = explode("->", $searchRelation);
                unset($searchColumn[0]);
                $searchColumn = array_values($searchColumn);
                if (count($searchColumn) > 1)
                    $query = $query->whereRelation($relationName, implode("->", $searchColumn), 'LIKE', '%' . $request->search['value'] . '%');
                else
                    $query = $query->whereRelation($relationName, $searchColumn[0], 'LIKE', '%' . $request->search['value'] . '%');
            }
            // search in option relation column
            if (str_contains($column['name'], '[OR]')) {
                $searchRelation = str_replace("[OR]", "", $column['name']);
                $relationName = explode("->", $searchRelation)[0];
                $searchColumn = explode("->", $searchRelation);
                unset($searchColumn[0]);
                $searchColumn = array_values($searchColumn);
                if (count($searchColumn) > 1)
                    $query = $query->whereRelation($relationName, implode("->", $searchColumn), 'LIKE', '%' . $column['search']['value'] . '%');
                else
                    $query = $query->whereRelation($relationName, $searchColumn[0], 'LIKE', '%' .  $column['search']['value'] . '%');
            }
        }

        return $query;
    }
}
