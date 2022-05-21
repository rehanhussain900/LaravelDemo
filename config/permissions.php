<?php

return [
    'permissions' => [
        'dashboard'               => [
            'title'       => 'Admin Dashboard',
            'description' => 'Access Admin Dashboard',
            'abilities'   => [
                'access dashboard' => [
                    'title'       => 'Access Admin Dashboard',
                    'description' => 'Access Administrator Dashboard',
                ],
                'manage settings'  => [
                    'title'       => 'Change Dashboard Settings',
                    'description' => 'Add changes to the Admin Dashboard for modules. <strong>This permission should be assigned carefully</strong>',
                ]
            ],
        ],
        /* --------------------------------------------------------------
         *  User Management
         * --------------------------------------------------------------
         */
        'user'                    => [
            'title'       => 'Users',
            'description' => 'Access and Manage Users',
            'abilities'   => [
                'access users'     => [
                    'title'       => 'List All Users',
                    'description' => 'See basic info of All Users',
                ],
                'add user'         => [
                    'title'       => 'Add User',
                    'description' => 'Add/Register new User',
                ],
                'edit user'        => [
                    'title'       => 'Edit User',
                    'description' => 'Modify User profile details',
                ],
                'delete user'      => [
                    'title'       => 'Delete User',
                    'description' => 'Delete User',
                ],
                'edit own profile' => [
                    'title'       => 'Edit Own Profile',
                    'description' => 'Edit Own Profile',
                ],
            ],
        ],
        /* --------------------------------------------------------------
         *  Roles
         * --------------------------------------------------------------
         */
        'role'                    => [
            'title'       => 'Roles and Abilities',
            'description' => 'Access and manage user Roles and Abilities/Permissions',
            'abilities'   => [
                'access roles'     => [
                    'title'       => 'List All Roles',
                    'description' => 'See basic info of All Roles',
                ],
                'add role'         => [
                    'title'       => 'Add Role',
                    'description' => 'Add new Role',
                ],
                'edit role'        => [
                    'title'       => 'Edit Role',
                    'description' => 'Modify Role details',
                ],
                'delete role'      => [
                    'title'       => 'Delete Role',
                    'description' => 'Delete Role',
                ],
                'edit permissions' => [
                    'title'       => 'Edit Permissions',
                    'description' => 'Modify Permissions for a Role',
                ],
            ],
        ],
        /* --------------------------------------------------------------
         *  Contracts
         * --------------------------------------------------------------
         */
        'contract'                => [
            'title'       => 'Contracts',
            'description' => 'Access and Manage Contracts',
            'abilities'   => [
                'access contracts'        => [
                    'title'       => 'List Unsigned Contracts',
                    'description' => 'See basic info of Unsigned Contracts',
                ],
                'access signed contracts' => [
                    'title'       => 'List All Contracts',
                    'description' => 'See basic info of All Contracts',
                ],
                'add contract'            => [
                    'title'       => 'Add Contract',
                    'description' => 'Add new Contract',
                ],
                'assign contract'            => [
                    'title'       => 'Assign Contract',
                    'description' => 'Assign Contract to Technician',
                ],
                'edit contract'           => [
                    'title'       => 'Edit Contract',
                    'description' => 'Modify Contract details',
                ],
                'delete contract'         => [
                    'title'       => 'Delete Contract',
                    'description' => 'Delete Contract',
                ],
            ],
        ],
        /* --------------------------------------------------------------
         *  Misc Deposits
         * --------------------------------------------------------------
         */
        'misc-deposits'           => [
            'title'       => 'Misc Deposits',
            'description' => 'Access and Manage Misc Deposits',
            'abilities'   => [
                'access misc deposits'     => [
                    'title'       => 'Access Branch Misc Deposits',
                    'description' => 'Access Only Owned Branch Misc Deposits',
                ],
                'access all misc deposits' => [
                    'title'       => 'Access All Misc Deposits',
                    'description' => 'Access and export Misc Deposits for all branches',
                ],
                'create misc deposits'     => [
                    'title'       => 'Add Misc Deposit',
                    'description' => 'Add new misc deposit record',
                ],
                'edit misc deposits'       => [
                    'title'       => 'Edit Misc Deposit',
                    'description' => 'Edit Misc Deposit entry',
                ],
                'delete misc deposits'     => [
                    'title'       => 'Delete Misc Deposit',
                    'description' => 'Delete Misc Deposit Entry',
                ],
            ],
        ],
        /* --------------------------------------------------------------
         *  Daily Production Report
         * --------------------------------------------------------------
         */
        'daily-production-report' => [
            'title'       => 'Daily Production Reports',
            'description' => 'Access and Manage Daily Production Reports',
            'abilities'   => [
                'access dpr' => [
                    'title'       => 'Access Daily Production Reports',
                    'description' => 'Access Daily Production Reports Submitted by Technician',
                ],
                'create dpr' => [
                    'title'       => 'Add Daily Production Reports',
                    'description' => 'Add  Daily Production Report record',
                ],
                'edit dpr'   => [
                    'title'       => 'Edit Daily Production Reports',
                    'description' => 'Edit Daily Production Reports entry',
                ],
                'delete dpr' => [
                    'title'       => 'Delete Daily Production Reports',
                    'description' => 'Delete Daily Production Reports Entry',
                ],
                'approve dpr' => [
                    'title'       => 'Approve Daily Production Reports',
                    'description' => 'Approve Daily Production Reports Entry',
                ],
            ],
        ],

        /* --------------------------------------------------------------
         *  Quality Assurance Surveys
         * --------------------------------------------------------------
         */
        'quality-assurance-survey' => [
            'title'       => 'Quality Assurance Surveys',
            'description' => 'Access and Manage Quality Assurance Surveys',
            'abilities'   => [
                'access qas' => [
                    'title'       => 'Access Quality Assurance Surveys',
                    'description' => 'Access Quality Assurance Survey Submitted by Auditor',
                ],
                'create qas' => [
                    'title'       => 'Add Quality Assurance Surveys',
                    'description' => 'Add Quality Assurance Survey record',
                ],
                'edit qas'   => [
                    'title'       => 'Edit Quality Assurance Surveys',
                    'description' => 'Edit Quality Assurance Survey entry',
                ],
                'delete qas' => [
                    'title'       => 'Delete Quality Assurance Surveys',
                    'description' => 'Delete Quality Assurance Survey Entry',
                ]
            ],
        ],
    ],
    'roles_map'   => [
        'Division Controller'                                     => 'Controller',
        "Auditor"                                                 => "TBD (To Be Determined)",
        "Area Residential Sales Mgr"                              => "Manager",
        "Assistant Division President"                            => "Regional VP",
        "Auditor - Full-time"                                     => "TBD (To Be Determined)",
        "Auditor - Part-time"                                     => "TBD (To Be Determined)",
        "Branch Manager"                                          => "Manager",
        "Branch Manager Trainee"                                  => "Manager",
        "Builder CSR"                                             => "Customer Service Representative",
        "Builder CSR - CA Only"                                   => "Customer Service Representative",
        "Builder Sales Representative"                            => "Customer Service Representative",
        "Builder Sales Representative - CA Only"                  => "Customer Service Representative",
        "Builder Termite Techinician"                             => "Technician",
        "Builder Termite Technician - Full-time"                  => "Technician",
        "Call Center Rep"                                         => "TBD (To Be Determined)",
        "Call Center Supervisor"                                  => "TBD (To Be Determined)",
        "Chief Financial Officers"                                => "TBD (To Be Determined)",
        "Commercial Sales Representative"                         => "Customer Service Representative",
        "Customer Service Rep 1 - Full-time"                      => "Customer Service Representative",
        "Customer Service Rep 1 - Full-time CA Only"              => "Customer Service Representative",
        "Customer Service Rep 1 - Part-time"                      => "Customer Service Representative",
        "Customer Service Rep 1 - Part-time CA Only"              => "Customer Service Representative",
        "Customer Service Rep 2 - Full Time"                      => "Customer Service Representative",
        "Customer Service Rep 2 - Full Time CA ONLY"              => "Customer Service Representative",
        "Customer Service Rep 2 - Part Time"                      => "Customer Service Representative",
        "Customer Service Rep 3 - Full Time"                      => "Customer Service Representative",
        "Customer Service Rep 3 - Full Time CA ONLY"              => "Customer Service Representative",
        "Customer Service Rep 3 - Part Time"                      => "Customer Service Representative",
        "Database Developer"                                      => "TBD (To Be Determined)",
        "Dir Human Resources"                                     => "Regional VP",
        "Dir Marketing"                                           => "Regional VP",
        "Dir Training"                                            => "Regional VP",
        "Division Administration"                                 => "Regional VP",
        "Division President"                                      => "Regional VP",
        "Field Customer Service Support Manager"                  => "Manager",
        "Field Supervisor"                                        => "Manager",
        "Field Supervisor - CA Only"                              => "Manager",
        "Field Support Customer Svc Supervisor"                   => "Manager",
        "Field Systems Support Manager"                           => "Manager",
        "General Manager"                                         => "Manager",
        "General Manager - CA Only"                               => "Manager",
        "Human Resources Manager"                                 => "Manager",
        "Information Technology Manager"                          => "Manager",
        "Inside Residential Sales Rep - Full-time"                => "Sales",
        "Inside Residential Sales Rep - Full-time CA Only"        => "Sales",
        "Inside Residential Sales Rep - Part-time"                => "Sales",
        "Inside Residential Sales Rep - Part-time CA Only"        => "Sales",
        "Inside Sales Rep - Driving"                              => "Sales",
        "Inside Res Sales Rep-Driving"                            => "Sales",
        "Inside Sales Rep - Driving - CA Only"                    => "Sales",
        "Inside Sales Rep - Driving PT"                           => "Sales",
        "Installer"                                               => "Technician",
        "Installer - CA Only"                                     => "Technician",
        "Installer - Full-time"                                   => "Technician",
        "Installer - Part-time"                                   => "Technician",
        "Lawn Technician"                                         => "Technician",
        "Managing Director of IT"                                 => "Regional VP",
        "Marketing & Communication Strategist"                    => "Regional VP",
        "Marketing Mgr"                                           => "Regional VP",
        "Office Manager"                                          => "Manager",
        "Office Manager - Exempt"                                 => "Manager",
        "Office Manager - Exempt CA Only"                         => "Manager",
        "Office Manager - Non-Exempt"                             => "Manager",
        "Office Manager - NE"                                     => "Manager",
        "Office Manager - Non-Exempt CA Only"                     => "Manager",
        "Operations Manager"                                      => "Manager",
        "PC Tech/E - Full-time (Base plus production pay)"        => "Technician",
        "PC Tech/E - Part-time (Base plus production pay)"        => "Technician",
        "PC Tech/NE - Full-time  (Hourly plus overtime)"          => "Technician",
        "PC Tech/NE - Part-time (Hourly plus overtime) - CA Only" => "Technician",
        "PC Tech/NE (Hourly plus overtime) - CA Only"             => "Technician",
        "PC Technician/NE (Hourly plus overtime)"                 => "Technician",
        "QA Coordinator"                                          => "TBD (To Be Determined)",
        "Region Controller"                                       => "TBD (To Be Determined)",
        "Regional Operations Director"                            => "Regional VP",
        "Regional Sales Manager"                                  => "Manager",
        "Regional Technical Director"                             => "Regional VP",
        "Regional VP"                                             => "Regional VP",
        "Reporting and Data Manager"                              => "Manager",
        "Residential Sales Rep - Full-time"                       => "Sales",
        "Sales Manager"                                           => "Manager",
        "Sales Manager - CA Only"                                 => "Manager",
        "Sales Supervisor"                                        => "Manager",
        "Senior HR Manager"                                       => "Regional VP",
        "Senior Project Manager"                                  => "Regional VP",
        "Sr. Systems Administrator"                               => "Regional VP",
        "Sr. VP Organization Develop"                             => "Regional VP",
        "Staff Accountant"                                        => "TBD (To Be Determined)",
        "Svc Mgr/Termite Svc Mgr"                                 => "Manager",
        "Svc Mgr Termite Svc Mgr"                                 => "Manager",
        "Svc Mgr/Termite Svc Mgr - CA Only"                       => "Manager",
        "Termite Technician - Full-time"                          => "Technician",
        "Termite Technician"                                      => "Technician",
        "Training Specialist"                                     => "TBD (To Be Determined)",
        "VP Builder Sales"                                        => "Regional VP",
        "VP Marketing"                                            => "Regional VP",
        "VP National Accounts"                                    => "Regional VP",
        "VP Residential Sales"                                    => "Regional VP",
        "VP Technical Services"                                   => "Regional VP",
    ],
];