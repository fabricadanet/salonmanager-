<?php

class Model {
    protected $table;
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function all() {
        $where = $this->hasDeletedAt() ? " WHERE deleted_at IS NULL" : "";
        $stmt = $this->db->query("SELECT * FROM {$this->table}{$where}");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $where = $this->hasDeletedAt() ? " AND deleted_at IS NULL" : "";
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id{$where} LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);
        
        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute($data)) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function update($id, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "{$key} = :{$key}, ";
        }
        $fields = rtrim($fields, ', ');
        
        $data['id'] = $id;
        
        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        if ($this->hasDeletedAt()) {
            return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
        }
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public function where($field, $value) {
        $where = $this->hasDeletedAt() ? " AND deleted_at IS NULL" : "";
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = :value{$where}");
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll();
    }

    public function paginate($page = 1, $limit = 10, $filters = []) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT * FROM {$this->table}";
        $params = [];
        
        if ($this->hasDeletedAt()) {
            $filters['deleted_at'] = 'NULL';
        }

        if (!empty($filters)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($filters as $field => $value) {
                if ($value === 'NULL') {
                    $conditions[] = "{$field} IS NULL";
                } elseif (strpos($value, '%') !== false || strpos($value, '*') !== false) {
                    $value = str_replace('*', '%', $value);
                    $conditions[] = "{$field} LIKE :{$field}";
                    $params[$field] = $value;
                } else {
                    $conditions[] = "{$field} = :{$field}";
                    $params[$field] = $value;
                }
            }
            $sql .= implode(' AND ', $conditions);
        }
        
        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue(":{$key}", $val);
        }
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function count($filters = []) {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $params = [];
        
        if ($this->hasDeletedAt()) {
            $filters['deleted_at'] = 'NULL';
        }

        if (!empty($filters)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($filters as $field => $value) {
                if ($value === 'NULL') {
                    $conditions[] = "{$field} IS NULL";
                } elseif (strpos($value, '%') !== false || strpos($value, '*') !== false) {
                    $value = str_replace('*', '%', $value);
                    $conditions[] = "{$field} LIKE :{$field}";
                    $params[$field] = $value;
                } else {
                    $conditions[] = "{$field} = :{$field}";
                    $params[$field] = $value;
                }
            }
            $sql .= implode(' AND ', $conditions);
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return (int) ($result['total'] ?? 0);
    }

    protected function hasDeletedAt() {
        $stmt = $this->db->query("PRAGMA table_info({$this->table})");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['name'] === 'deleted_at') {
                return true;
            }
        }
        return false;
    }
}
