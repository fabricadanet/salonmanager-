<?php

class Model {
    protected $table;
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
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
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public function where($field, $value) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = :value");
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll();
    }

    public function paginate($page = 1, $limit = 10, $filters = []) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT * FROM {$this->table}";
        $params = [];
        
        if (!empty($filters)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($filters as $field => $value) {
                if (strpos($value, '%') !== false || strpos($value, '*') !== false) {
                    $value = str_replace('*', '%', $value);
                    $conditions[] = "{$field} LIKE :{$field}";
                } else {
                    $conditions[] = "{$field} = :{$field}";
                }
                $params[$field] = $value;
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
        
        if (!empty($filters)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($filters as $field => $value) {
                if (strpos($value, '%') !== false || strpos($value, '*') !== false) {
                    $value = str_replace('*', '%', $value);
                    $conditions[] = "{$field} LIKE :{$field}";
                } else {
                    $conditions[] = "{$field} = :{$field}";
                }
                $params[$field] = $value;
            }
            $sql .= implode(' AND ', $conditions);
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return (int) ($result['total'] ?? 0);
    }
}
