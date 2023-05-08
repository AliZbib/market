CREATE TABLE products (
  name VARCHAR(255),
  price DECIMAL(10,2),
  barcode VARCHAR(20)
);
INSERT INTO products (name, price, barcode) VALUES
  ('Sima', 9.99, ''),
  ('juice', 12.99, '5285000320944'),
  ('chocolate', 7.50, '8690504159032');
CREATE TABLE cart (
  name VARCHAR(255),
  price DECIMAL(10,2),
  barcode VARCHAR(20)
);