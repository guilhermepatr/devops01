CREATE TABLE insumos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo TEXT CHECK (tipo IN ('Ração', 'Equipamento', 'Remédio', 'Outros')),
    quantidade INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);
