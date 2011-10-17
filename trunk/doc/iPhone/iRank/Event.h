//
//  Event.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface Event : NSObject {
    
    NSInteger eventId;
    NSInteger rankingId;
    NSString *rankingName;
    NSString *eventName;
    NSString *eventDate;
    NSString *startTime;
}

@property (nonatomic, readwrite) NSInteger eventId;
@property (nonatomic, readwrite) NSInteger rankingId;
@property (nonatomic, retain) NSString *eventName;
@property (nonatomic, retain) NSString *rankingName;
@property (nonatomic, retain) NSString *eventDate;
@property (nonatomic, retain) NSString *startTime;

@end
