//
//  Event.h
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
@class RankingDetailViewController;

@interface Ranking : NSObject {
    
    NSInteger rankingId;
    NSInteger rankingTypeId;
    NSInteger gameStyleId;
    
    NSString *rankingName;
    NSString *rankingType;
    NSString *gameStyle;
    NSString *credit;
    NSString *startDate;
    NSString *finishDate;
    NSString *isPrivate;
    NSString *defaultBuyin;
    NSString *players;
    NSString *event;
}

@property (nonatomic, readwrite) NSInteger rankingId;
@property (nonatomic, readwrite) NSInteger rankingTypeId;
@property (nonatomic, readwrite) NSInteger gameStyleId;
@property (nonatomic, retain) NSString *rankingName;
@property (nonatomic, retain) NSString *rankingType;
@property (nonatomic, retain) NSString *gameStyle;
@property (nonatomic, retain) NSString *credit;
@property (nonatomic, retain) NSString *startDate;
@property (nonatomic, retain) NSString *finishDate;
@property (nonatomic, retain) NSString *isPrivate;
@property (nonatomic, retain) NSString *defaultBuyin;
@property (nonatomic, retain) NSString *players;
@property (nonatomic, retain) NSString *events;

-(void)save:(id)sender;
@end
