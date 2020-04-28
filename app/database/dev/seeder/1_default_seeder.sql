-- seeder active_status
INSERT INTO active_status (id, name) 
VALUES 
    ('817c906f-5638-49f2-8ef2-3c49bbbfc86f', 'Active'),
    ('0dda02b9-0bfd-4a5f-a37a-0610ff572892', 'Non Active');

-- seeder type
INSERT INTO type (id, name) 
VALUES 
    ('0fd07207-128d-46c3-8189-df98f0a894a1', 'System Administrator'),
    ('0752ce08-41ae-4d0e-9fbc-e5625374c700', 'Owner'),
    ('05c55aa1-ce23-43a7-b891-91056678e684', 'Employee'),
    ('4c100417-3c19-461a-8f6f-f3ecb529849e', 'Customer'),
    ('be09b7c5-3be3-424e-81a6-ca665e2fc4db', 'Contact Person');

-- seeder gender
INSERT INTO gender (id, name) 
VALUES 
    ('994de175-0e52-4d2c-81c3-7ec220323cea', 'Male'),
    ('2c3d56d8-99e4-4dbe-9b70-9401cb93da42', 'Female');

-- seeder contact
INSERT INTO contact (id, name, typeId, active_statusId) 
VALUES 
    ('296986a3-2fd0-46dc-adc9-25ab4fccf490', 'Supervisor', '0fd07207-128d-46c3-8189-df98f0a894a1', '817c906f-5638-49f2-8ef2-3c49bbbfc86f');

-- seeder user
INSERT INTO user (id, username, password, contactId, active_statusId) 
VALUES 
    ('73eeb453-bd43-4bbe-a58c-5533418d80d2', 'Supervisor', '$2y$10$xCodwAh2QeXbnzhDsM4I4.PPq.7ddW06THns63kU/j9mgaGHTm2yi', '296986a3-2fd0-46dc-adc9-25ab4fccf490', '817c906f-5638-49f2-8ef2-3c49bbbfc86f');

-- seeder access
INSERT INTO access (id, name, title, router, position) 
VALUES 
    ('f704f49f-3d30-4c1d-b433-1cb291df8e0e', 'Home', 'Home', '/', 0);

-- seeder access_right
INSERT INTO access_right (id, userId, accessId, isCanInsert, isCanUpdate, isCanDelete, isCanRead) 
VALUES 
    ('37e62c8e-0950-41d1-8a86-85d3bbb0abcb', '73eeb453-bd43-4bbe-a58c-5533418d80d2', 'f704f49f-3d30-4c1d-b433-1cb291df8e0e', 1, 1, 1, 1);