//
//  EditableTableViewCell.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "EditableTableViewCell.h"

@implementation EditableTableViewCell
@synthesize leftLabel, rightTextField;

- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier
{
    self = [super initWithStyle:style reuseIdentifier:reuseIdentifier];

    leftLabel = [[UILabel alloc] initWithFrame:CGRectZero];
    [leftLabel setBackgroundColor:[UIColor clearColor]];
    [leftLabel setTextColor:[UIColor colorWithRed:.285 green:.376 blue:.541 alpha:1]];
    [leftLabel setFont:[UIFont boldSystemFontOfSize:12]];
    [leftLabel setTextAlignment:UITextAlignmentRight];
    [leftLabel setText:@"Left Field"];
    [self addSubview:leftLabel];
    
    rightTextField = [[UITextField alloc] initWithFrame:CGRectZero];
    rightTextField.contentVerticalAlignment = UIControlContentVerticalAlignmentCenter;
//    [rightTextField setDelegate:self];
    [rightTextField setPlaceholder:@"Right Field"];
    [rightTextField setFont:[UIFont systemFontOfSize:15]];
    
    rightTextField.clearButtonMode = UITextFieldViewModeWhileEditing;
    
    // FOR MWF USE DONE
    [rightTextField setReturnKeyType:UIReturnKeyDone];
    
    [self addSubview:rightTextField];
    
    return self;
}

- (void)layoutSubviews {

	[super layoutSubviews];
	
    CGRect origFrame = self.contentView.frame;
	
    if (leftLabel.text != nil) {
	
        leftLabel.frame = CGRectMake(origFrame.origin.x, origFrame.origin.y, 90, origFrame.size.height+1);
		rightTextField.frame = CGRectMake(origFrame.origin.x+105, origFrame.origin.y+1, origFrame.size.width-120, origFrame.size.height+1);
	} else {
		leftLabel.hidden = YES;
		NSInteger imageWidth = 0;
		if (self.imageView.image != nil) {
			imageWidth = self.imageView.image.size.width + 5;
		}
		rightTextField.frame = CGRectMake(origFrame.origin.x+imageWidth+10, origFrame.origin.y, origFrame.size.width-imageWidth-20, origFrame.size.height);
	}
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated
{
    [super setSelected:selected animated:animated];

    if( selected && self.selectionStyle!=UITableViewCellEditingStyleNone ){
        
        [leftLabel setTextColor:[UIColor whiteColor]];
        [rightTextField setTextColor:[UIColor whiteColor]];
     }else{
         [leftLabel setTextColor:[UIColor colorWithRed:.285 green:.376 blue:.541 alpha:1]];
         [rightTextField setTextColor:[UIColor blackColor]];
     }
}

@end
