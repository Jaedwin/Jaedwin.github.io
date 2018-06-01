CREATE TABLE User(
		ID int NOT NULL AUTO_INCREMENT,
		Age int NOT NULL,
		Email varchar(256) NOT NULL,
		Firstname varchar(256) NOT NULL,
		Lastname varchar(256) NOT NULL,
		Username varchar(256) NOT NULL, 
		Password varchar(256) NOT NULL, 
		CurrentWeight int NOT NULL,
		GoalWeight int NOT NULL,
		Height float NOT NULL,
		PRIMARY KEY (ID)
	);

CREATE TABLE WorkoutRoutine(
    WorkoutID int NOT NULL AUTO_INCREMENT,
	UserId int NOT NULL,
    Name varchar(256) NOT NULL, 
    PRIMARY KEY(WorkoutID),
    FOREIGN KEY(UserId) REFERENCES User(ID) ON UPDATE CASCADE ON DELETE CASCADE
);



CREATE TABLE Exercise(
	ID int NOT NULL AUTO_INCREMENT,
    Name varchar(256) NOT NULL, 
    BodyPart varchar(256) NOT NULL,
    Equipment varchar(45) NOT NULL,
    PRIMARY KEY(ID),
    UNIQUE(ID)
);

CREATE TABLE ConsistsOf(
	UserId int NOT NULL,
    Workout_Id int NOT NULL,
	Name varchar(256) NOT NULL,
    ExerciseId int NOT NULL, 
    Sets int NOT NULL, 
    Reps int NOT NULL,
    FOREIGN KEY(Workout_Id) REFERENCES WorkoutRoutine(WorkoutID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(ExerciseId) REFERENCES Exercise(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE NutritionPlan(
	UserId int NOT NULL,
	Name varchar(256) NOT NULL,
	MaxCals float,
	MaxProtein float,
	MaxCarbs float,
	MaxFats float,
	FOREIGN KEY (UserId) REFERENCES User(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Food(
	ID int NOT NULL AUTO_INCREMENT,
	Name varchar(256),
	Calories float,
	Protein float,
	Carbs float,
	Fat float,
	PRIMARY KEY (ID),
	UNIQUE(ID)
);

CREATE TABLE MadeUpOf(
	UserId int NOT NULL,
	NutritionPlanName varchar(256),
	FoodId int,
	FoodName varchar(256),
	FOREIGN KEY(UserId) REFERENCES User (ID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(FoodId) REFERENCES Food (ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Client(
	ID int NOT NULL AUTO_INCREMENT,
	UserId int NOT NULL, 
    Phone varchar(256) NOT NULL, 
    Address varchar(256) NOT NULL,
    Availability varchar(250) NOT NULL, 
    PRIMARY KEY(ID),
    UNIQUE(ID),
    FOREIGN KEY(UserId) REFERENCES User(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Gym(
	Name varchar(45) NOT NULL,
	Location varchar(256) NOT NULL,
	PRIMARY KEY (Location)
);


CREATE TABLE Employee(
	SIN int(9) NOT NULL,
	UserId int NOT NULL, 
    Wage double NOT NULL, 
    Address varchar(256) NOT NULL, 
    Phone varchar(256) NOT NULL, 
    Schedule varchar(250) NOT NULL,
    PRIMARY KEY(SIN),
    UNIQUE(SIN), 
    FOREIGN KEY(UserId) REFERENCES User(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(Address) REFERENCES Gym(Location) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Coaches(
	SIN int(9) NOT NULL, 
    MemberId int NOT NULL, 
    FOREIGN KEY(SIN) REFERENCES Employee(SIN) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(MemberId) REFERENCES Client(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Owns(
	Location varchar(256) NOT NULL,
	SIN int(9) NOT NULL,
	FOREIGN KEY(Location) REFERENCES Gym (Location) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(SIN) REFERENCES Employee(SIN) ON UPDATE CASCADE ON DELETE CASCADE 
);

CREATE TABLE CanBeMemberOf(
	Location varchar(256) NOT NULL,
	MemberId int NOT NULL,
	FOREIGN KEY(Location) REFERENCES Gym(Location) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(MemberId) REFERENCES Client(ID) ON UPDATE CASCADE ON DELETE CASCADE
);
INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(17, 'spiderman@gmail.com', 'Peter', 'Parker', 'spiders4life', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 150, 167, 177.8);
		
	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(45, 'ironman@gmail.com', 'Tony', 'Stark', 'anthony_stark', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 225, 100, 185.42);

	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(48, 'antman@gmail.com', 'Scot', 'Lang', 'antz_555', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 172, 180, 177.8);

	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(96, 'captainamerica@gmail.com', 'Steve', 'Rogers', 'USA_number1', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 194, 215, 187.96);

	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(42, 'doctorstrange@gmail.com', 'Steven', 'Strange', 'wizard_boi', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 172, 175, 185.42);

	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(42, 'scarletwitch@gmail.com', 'Wanda', 'Maximoff', 'red_witch', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 132, 125, 170.18);

	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(51, 'captainmarvel@gmail.com', 'Carol', 'Danvers', 'ms_marvel', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 165, 170, 180.34);
		
	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(49, 'hulk@gmail.com', 'Bruce', 'Banner', 'green_man', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 128, 900, 175.26);

	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height )
		VALUES(34, 'thor@gmail.com', 'Thor', 'Odinson', 'God_of_Thunder', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 200, 220, 185.42);
		
	INSERT INTO USER (Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height)
		VALUES(37, 'blackwidow@gmail.com', 'Natasha', 'Romanova', 'spy_girl', '$2y$10$fBWp1Wg4bISRImNqMPZZeeYAESlH59W45.ksSNj5.LFhPlkIdc.qK', 135, 140, 167.64);

INSERT INTO Client (UserId, Phone, Address, Availability)
    VALUES(1,'123-555-4567', '350 5th Ave, New York, NY', 'M: 2:00 p.m - 5:00 W: 3:00 F: 10:00 - 7:00');
INSERT INTO Client (UserId, Phone, Address, Availability)
    VALUES(2, '444-555-6666', '1600 Pennsylvania Ave NW, Washington', 'T: 2:00 p.m - 5:00 TH: 3:00 Su: 10:00 - 7:00');
INSERT INTO Client (UserId, Phone, Address, Availability)
    VALUES(3, '999-555-4569', '101 9 Ave SW, Calgary, AB', 'M: 1:00 p.m - 9:00 W: 4:00 F: 11:00 - 8:00');
INSERT INTO Client (UserId, Phone, Address, Availability)
    VALUES(4, '123-555-4567', '282039 Fox Meadow Vale RR2', 'F: 10:00 - 7:00 Sat: 5:00-8:00 Su: 11;00 - 7:00');

INSERT INTO GYM (Name, Location)
    VALUES('World Health Calgary Gyms','1677, 1632 - 14 Ave NW');
INSERT INTO GYM (Name, Location)
    VALUES('Univercity of Calgary Active Living','2500 Univercity Drive Northwest');
INSERT INTO GYM (Name, Location)
    VALUES('Golds Gym','360 Hampton Drive Venice CA');
INSERT INTO GYM (Name, Location)
    VALUES('Firehouse Fitness','3518 7th St');

INSERT INTO Employee (SIN, UserId, Wage, Address, Phone, Schedule)
    VALUES(123456789, 5, 20.00,'1677, 1632 - 14 Ave NW','123-888-9898','F: 10:00 - 7:00 Sat: 5:00-8:00 Su: 11;00 - 7:00');
INSERT INTO Employee (SIN, UserId, Wage, Address, Phone, Schedule)
    VALUES(123123123, 6, 40.00,'2500 Univercity Drive Northwest','365-989-9999','M: 2:00 p.m - 5:00 W: 3:00 F: 10:00 - 7:00');
INSERT INTO Employee (SIN, UserId, Wage, Address, Phone, Schedule)
    VALUES(999999991, 7, 90.00,'360 Hampton Drive Venice CA','654-897-1235','M: 1:00 p.m - 9:00 W: 4:00 F: 11:00 - 8:00');
INSERT INTO Employee (SIN, UserId, Wage, Address, Phone, Schedule)
    VALUES(999999999, 8, 50.00,'3518 7th St','403-987-6598','F: 10:00 - 6:00 Sat: 5:00-8:00 Su: 11;00 - 9:00');
	
INSERT INTO Coaches(SIN, MemberId)
	VALUES(123456789, 1);
INSERT INTO Coaches(SIN, MemberId)
	VALUES(123123123, 2);
INSERT INTO Coaches(SIN, MemberId)
	VALUES(999999991, 3);
INSERT INTO Coaches(SIN, MemberId)
	VALUES(999999999, 4);	

INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(1,'Bulking','2500','160','100','120');
	
INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(2,'Bulking','2600','180','90','80');
	
INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(3,'Cutting','1500','900','80','80');
	
INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(8,'Thanos_Bulk','3000','200','150','150');
	
INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(9,'Kito','1200','120','0','0');
	
INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(10,'OHOP','456','90','50','60');
	
INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(1,'Cut','100','50','66','88');
	
INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats)
	VALUES(2,'SHWARMA_CHEAT_DAY','3000','200','100','120');

INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Apple', 80, 0, 30, 0);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Banana', 89.8, 0.3, 23, 1.1);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Carrots', 52.5, 1, 12.3, 0.3);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Broccoli', 30.9, 2.6, 2, 0.3);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Cheese', 110, 6, 0, 9);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Milk', 207.5, 7.9, 25.9, 8.5);

INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Chicken Breast', 147, 25.7, 0.1, 4.1);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Steak', 220, 22, 0, 19);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Pork', 36.2, 1.4, 2.4, 2.4);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Bread', 76.7, 2.5, 14.2, 1);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Shwarma', 323, 16.4, 30, 15.6);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Beef Pho', 366.1, 11.9, 73.4, 2.7);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Oatmeal', 71.6, 2.5, 12.8, 1.2);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Pizza', 240, 13, 35, 15.5);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Tuna', 110, 26, 0, 0.5);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Salmon', 240, 28, 0, 14);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Eggs', 71.5, 6.3, 0.4, 4.8);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Hashbrowns', 130, 1, 15, 7);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Pancakes', 54.9, 1.5, 10.4, 0.7);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Rice', 97, 2, 31, 3);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Quesidlla', 550, 24, 0, 7);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Ice Cream', 114, 2.2, 6.4, 16.4);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Popcorn', 55, 1, 6.3, 3.1);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Shrimp', 65, 15, 0.5, 0.5);
	
INSERT INTO Food(Name, Calories, Protein, Carbs, Fat)
	VALUES('Bacon', 100, 5, 0, 8);

INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Bulking', 5, 'Cheese');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Bulking', 7, 'Chicken Breast');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Bulking', 8, 'Steak');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Bulking', 9, 'Pork');
	
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'Bulking', 5, 'Cheese');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'Bulking', 7, 'Chicken Breast');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'Bulking', 8, 'Steak');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'Bulking', 9, 'Bread');

INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(3, 'Cutting', 1, 'Apple');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(3, 'Cutting', 2, 'Banana');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(3, 'Cutting', 3, 'Carrots');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(3, 'Cutting', 4, 'Broccoli');

INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(8, 'Thanos_Bulk', 7, 'Chicken Breast');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(8, 'Thanos_Bulk', 8, 'Steak');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(8, 'Thanos_Bulk', 9, 'Pork');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(8, 'Thanos_Bulk', 16, 'Salmon');

INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(9, 'Kito', 22, 'Ice Cream');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(9, 'Kito', 8, 'Steak');

INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(10, 'OHOP', 13, 'Oatmeal');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(10, 'OHOP', 25, 'Bacon');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(10, 'OHOP', 24, 'Shrimp');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(10, 'OHOP', 23, 'Popcorn');

INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Cut', 16, 'Salmon');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Cut', 17, 'Eggs');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Cut', 4, 'Broccoli');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(1, 'Cut', 20, 'Rice');

INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'SHWARMA_CHEAT_DAY', 11, 'Shwarma');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'SHWARMA_CHEAT_DAY', 25, 'Bacon');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'SHWARMA_CHEAT_DAY', 14, 'Pizza');
INSERT INTO MadeUpOf(UserId, NutritionPlanName, FoodId, FoodName)
	VALUES(2, 'SHWARMA_CHEAT_DAY', 1, 'Apple');
	
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Bench Press', 'Chest', 'Barbell');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Shoulder Press', 'Shoulder', 'Dumbell');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Inclined Bench Press', 'Chest', 'Dumbell');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Side Lateral Raise', 'Shoulder', 'Dumbell');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Tricep Pushdown', 'Tricep', 'Cable Machine');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Tricep Kickback', 'Tricep', 'Cable Machine');
   
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Barbell Rows', 'Back', 'Barbell');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Seated Rows', 'Back', 'Cable Machine');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Face Pulls', 'Back', 'Cable Machine');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Inclined Dumbell Curl', 'Bicep', 'Dumbell');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Preacher Curl', 'Bicep', 'EZ Bar');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Hammer Curl', 'Bicep', 'Dumbell');

INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Barbell Squat', 'Legs', 'Barbell');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Leg Curl', 'Ham String', 'Leg Curl Machine');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Leg Extension', 'Quadricep', 'Leg Extension Machine');
    
INSERT Exercise(Name, BodyPart, Equipment)
	VALUES('Seated Calf Raise', 'Calves', 'Seated Calf Raise Machine');


INSERT WorkoutRoutine(UserId, Name)
	VALUES(1,'Push');

INSERT WorkoutRoutine(UserId, Name)
	VALUES(2,'Push');

INSERT WorkoutRoutine(UserId, Name)
	VALUES(3,'Pull');

INSERT WorkoutRoutine(UserId, Name)
	VALUES(4,'Legs');

INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(1,1, 'Push', 1, 3, 8);

INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(1,1, 'Push', 2, 3, 8);

INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(1,1, 'Push', 3, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(1,1, 'Push', 4, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(1,1, 'Push', 5, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(1,1, 'Push', 6, 3, 8);


INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(2,2, 'Push', 1, 3, 8);

INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(2,2, 'Push', 2, 3, 8);

INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(2,2, 'Push', 3, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(2,2, 'Push', 4, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(2,2, 'Push', 5, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(2,2, 'Push', 6, 3, 8);
    


INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(3,3, 'Pull', 7, 3, 8);

INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(3,3, 'Pull', 8, 3, 8);

INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(3,3, 'Pull', 9, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(3,3, 'Pull', 10, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(3,3, 'Pull', 11, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(3,3, 'Pull', 12, 3, 8);


INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(4,4, 'Legs', 13, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(4,4, 'Legs', 14, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(4,4, 'Legs', 15, 3, 8);
    
INSERT ConsistsOf(UserId, Workout_Id, Name, ExerciseId, Sets, Reps)
	VALUES(4,4, 'Legs', 16, 3, 8);


INSERT INTO Owns (Location, SIN)
	VALUES('1677, 1632 - 14 Ave NW', 123456789);
INSERT INTO Owns (Location, SIN)
	VALUES('2500 Univercity Drive Northwest', 123123123);
INSERT INTO Owns (Location, SIN)
	VALUES('360 Hampton Drive Venice CA', 999999991);
INSERT INTO Owns (Location, SIN)
	VALUES('3518 7th St', 999999999);

INSERT CanBeMemberOf(Location, MemberId)
	VALUES('1677, 1632 - 14 Ave NW', 1);
INSERT CanBeMemberOf(Location, MemberId)
	VALUES('2500 Univercity Drive Northwest', 2);
INSERT CanBeMemberOf(Location, MemberId)
	VALUES('360 Hampton Drive Venice CA', 3);
INSERT CanBeMemberOf(Location, MemberId)
	VALUES('3518 7th St', 4);
