//
//  EventPhoto.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface EventPhoto : NSObject {
    
}

@property (nonatomic, readwrite) int eventPhotoId;
@property (nonatomic, readwrite) int fileId;
@property (nonatomic, retain) NSString *imageUrl;
@property (nonatomic, retain) NSString *thumbUrl;
@end
