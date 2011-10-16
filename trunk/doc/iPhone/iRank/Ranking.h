//
//  Event.h
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>


@interface Ranking : NSObject {
    
    NSInteger rankingId;
    NSString *rankingName;
    NSString *players;
    NSString *event;
}

@property (nonatomic, readwrite) NSInteger rankingId;
@property (nonatomic, retain) NSString *rankingName;
@property (nonatomic, retain) NSString *players;
@property (nonatomic, retain) NSString *events;
@end
